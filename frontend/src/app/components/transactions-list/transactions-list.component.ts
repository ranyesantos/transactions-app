import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';

@Component({
  selector: 'app-list-transactions',
  templateUrl: './transactions-list.component.html',
  styleUrls: ['./transactions-list.component.css']
})
export class TransactionsListComponent implements OnInit {
  transactions: Transaction[] = [];
  currentPage: number = 1;
  totalPages: number = 0;
  errorMessage: string | null = null;

  categories: Category[] = [];

  selectedType: string = '';

  constructor(
    private transactionsService: TransactionsService,
    private router: Router,
    private categoriesService: CategoryService
  ) {}

  ngOnInit(): void {
    this.fetchTransactions(this.currentPage);
    this.fetchCategories();
  }

  fetchTransactions(page: number = 1, filters?: any): void {
  // Check if filters or page number are provided and mock data if needed.
  this.transactionsService.getTransactions(page, filters).subscribe({
    next: (data) => {
      this.transactions = data.data;
      this.totalPages = data.last_page;
      this.currentPage = data.current_page;
    },
    error: () => {
      // Fallback to mock data in case of error or during testing
      this.transactions = this.getMockTransactions();
      this.totalPages = 1;
      this.currentPage = 1;
    },
  });
}

// Mock function to return fake data
getMockTransactions(): Transaction[] {
  return [
    {
      id: 1,
      description: 'Sample Transaction 1',
      category_id: 2,
      amount: 150.5,
      type: 'debit',
      date: '2025-03-29',
    },
    {
      id: 2,
      description: 'Sample Transaction 2',
      category_id: 1,
      amount: 99.99,
      type: 'credit',
      date: '2025-03-28',
    },
    {
      id: 3,
      description: 'Sample Transaction 3',
      category_id: 3,
      amount: 200.0,
      type: 'debit',
      date: '2025-03-27',
    },
    {
      id: 4,
      description: 'Sample Transaction 4',
      category_id: 4,
      amount: 500.0,
      type: 'credit',
      date: '2025-03-26',
    },
    {
      id: 5,
      description: 'Sample Transaction 5',
      category_id: null,
      amount: 75.75,
      type: 'debit',
      date: '2025-03-25',
    },
  ];
}

  editTransaction(id: number): void {
    this.router.navigate(['/transaction/:id', id]);
  }

  deleteTransaction(id: number): void {
    if (confirm('Tem certeza de que deseja deletar esta transação?')) {
      this.transactionsService.deleteTransaction(id).subscribe(
        () => {
          this.transactions = this.transactions.filter(transaction => transaction.id !== id);
          alert('Transação deletada com sucesso');
        },
      );
    }
  }

  onFiltersChanged(): void {
    const filters = {
      type: this.selectedType,
    };
    this.fetchTransactions(this.currentPage, filters);
  }

  fetchCategories() {
    this.categoriesService.getCategories().subscribe({
      next: (data) => {
        this.categories = data;
      }
    });
  }

  getCategoryNameById(id: number | string | null): string {
    if (id === null) return 'N/A';
    const category = this.categories.find(cat => cat.id === Number(id));

    return category ? category.name : 'Categoria Desconhecida';
  }

  applyFilters(): void {
    this.fetchTransactions(this.currentPage);
  }

  pageChanged(page: number): void {
    this.currentPage = page;
    this.fetchTransactions(this.currentPage);
  }

}
