import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';

@Component({
  selector: 'app-transaction-edit',
  templateUrl: './transaction-edit.component.html',
  styleUrls: ['./transaction-edit.component.css']
})

export class TransactionEditComponent implements OnInit {
  transaction: Transaction = {
    id: 0,
    description: '',
    category_id: 0 || null,
    amount: 0,
    type: '',
    date: ''
  };

  categoryCreated: number | null = null;

  isNewCategory: boolean = false;
  newCategoryName: string = '';
  selectedCategory: number | null = null;
  categories: Category[] = [];

  errorMessages: {
    [key: string]: string[];
  } = {
    description: [],
    type: [],
    amount: [],
    date: [],
    category_id: [],
  };

  categoryErrors: { name: string[] } = {
    name: []
  };

  constructor(
    private transactionsService: TransactionsService,
    private route: ActivatedRoute,
    private router: Router,
    private categoriesService: CategoryService
  ) {}

  ngOnInit(): void {
    this.show();
    this.fetchCategories();
  }

  show(): void {
    const idString = this.route.snapshot.paramMap.get('id');
    const id = idString ? parseInt(idString, 10) : null;

    if (id) {
      this.fetchTransaction(id);
    }
  }

  fetchTransaction(id: number): void {
    this.transactionsService.getTransactionById(id).subscribe(
      data => {
        this.transaction = data;
      }
    );
  }

  editTransaction(): void {
    this.categoryErrors.name = [];

    if (this.isNewCategory && this.newCategoryName) {
      this.categoriesService.addCategory(this.newCategoryName).subscribe({
        next: (response) => {
          this.transaction.category_id = response.category.id;
          this.submitTransaction();
        },
        error: (err) => {
          this.categoryErrors.name = [''];

          if (err.error && err.error.errors)  {
            this.categoryErrors.name = err.error.errors['name'];
          }
        }
      });
    } else if (this.isNewCategory == null) {
      this.transaction.category_id = null;
      this.submitTransaction();
    } else {
      this.transaction.category_id = this.selectedCategory;
      this.submitTransaction();
    }

  }

  cancel(): void {
    this.router.navigate(['../']);
  }

  private submitTransaction(): void {
    this.transactionsService.editTransaction(this.transaction.id, this.transaction).subscribe({
      next: () => {
        this.router.navigate(['/transactions']);
      },
      error: (err) => {

        this.errorMessages = {
          description: [],
          type: [],
          amount: [],
          category_id: [],
          date: []
        };

        if (err.error && err.error.errors) {
          for (const field in err.error.errors) {
            if (this.errorMessages.hasOwnProperty(field)) {
              this.errorMessages[field] = err.error.errors[field];
            }
          }
        }
      }
    });
  }

  onTypeChange(): void {
    if (this.transaction.type === 'expense') {
      this.transaction.amount = -Math.abs(this.transaction.amount);
    } else if (this.transaction.type === 'income') {
      this.transaction.amount = Math.abs(this.transaction.amount);
    }
  }

  onCategoryChange(): void {
    this.categoryErrors.name = [];
    if (!this.isNewCategory && this.transaction && this.transaction.category_id) {
      this.selectedCategory = this.transaction.category_id;
    } else {
      this.selectedCategory = null;
      this.newCategoryName = '';
    }
  }

  fetchCategories() {
    this.categoriesService.getCategories().subscribe({
      next: (data) => {
        this.categories = data;
        if (this.transaction && this.transaction.category_id) {
          this.selectedCategory = this.transaction.category_id;
        }
      }
    });
  }





}
