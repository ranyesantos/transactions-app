import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Router } from '@angular/router';
import { TransactionsService, Transaction } from '../../services/transactions.service';
import { CategoryService, Category } from '../../services/categories.service';

@Component({
  selector: 'app-transaction-details',
  templateUrl: './transaction-details.component.html',
  styleUrls: ['./transaction-details.component.css']
})
export class TransactionDetailsComponent implements OnInit {
  transaction: Transaction = {
    id: 0,
    description: '',
    category_id: 0,
    amount: 0,
    type: '',
    date: ''
  };

  category: Category = {
    id: 0,
    name: '',
  }

  type: string = '';

  constructor(
    private route: ActivatedRoute,
    private transactionsService: TransactionsService,
    private categoryService: CategoryService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.show();
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
        this.showCategory();
      }
    );
  }

  translateType(): string {
    if (this.transaction.type === 'expense') {
      this.type = 'Despesa';
      return this.type;
    } else if (this.transaction.type === 'income') {
      this.type = 'Receita';
      return this.type;
    } else {
      return '';
    }
  }

  showCategory(): void {
    const id = this.transaction.category_id;

    if (id){
      this.fetchCategory(id);
    }
  }

  cancel(): void {
    this.router.navigate(['../']);
  }

  editTransaction(id: number): void {
    this.router.navigate(['/transaction/:id', id]);
  }

  deleteTransaction(id: number): void {
    if (confirm('Tem certeza de que deseja deletar esta transação?')) {
      this.transactionsService.deleteTransaction(id).subscribe(
        () => {
          alert('Transação deletada com sucesso!');
          this.router.navigate(['/transactions']);
        },
        error => {
          console.error('Erro ao deletar transação:', error);
          alert('Não foi possível deletar a transação.');
        }
      );
    }
  }

  fetchCategory(id: number): void {
    this.categoryService.getCategoryById(id).subscribe(
      data => {
        this.category = data;
        console.log(this.category);
      }
    );
  }

}
