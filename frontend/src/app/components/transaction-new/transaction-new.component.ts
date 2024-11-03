import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';

@Component({
  selector: 'app-new-transaction',
  templateUrl: './transaction-new.component.html',
  styleUrls: ['./transaction-new.component.css']
})

export class TransactionNewComponent implements OnInit {
  newTransaction: Transaction = {
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
    private router: Router, private categoriesService: CategoryService
  ) {}

  ngOnInit(): void {
    this.fetchCategories();
  }

  addTransaction(): void {
    this.categoryErrors.name = [];
    if (this.isNewCategory && this.newCategoryName) {
      this.categoriesService.addCategory(this.newCategoryName).subscribe({
        next: (response) => {
          this.newTransaction.category_id = response.category.id;
          this.submitTransaction();
        },
        error: (err) => {
          this.categoryErrors.name = [''];

          if (err.error && err.error.errors)  {
            this.categoryErrors.name = err.error.errors['name'];
          }
      }
      });
    }
    else if (this.selectedCategory) {
      this.newTransaction.category_id = this.selectedCategory;
      this.submitTransaction();
    } else {
      this.newTransaction.category_id = null;
      this.submitTransaction();
    }

  }

  cancel(): void {
    this.router.navigate(['../']);
  }

  private submitTransaction(): void {
    this.transactionsService.addTransaction(this.newTransaction).subscribe({
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
    if (this.newTransaction.type === 'expense' && this.newTransaction.amount > 0) {
      this.newTransaction.amount = -Math.abs(this.newTransaction.amount);
    }
  }

  onCategoryChange(): void {
    this.selectedCategory = null;
    this.newCategoryName = '';
  }

  fetchCategories() {
    this.categoriesService.getCategories().subscribe({
      next: (data) => {
        this.categories = data;
      }
    });
  }





}
