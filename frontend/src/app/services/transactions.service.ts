import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface Transaction {
  id: number;
  description: string;
  category_id: number | null;
  amount: number;
  type: string;
  date: string;
}

export interface PaginatedResponse {
  current_page: number;
  data: Transaction[];
  last_page: number;
  total: number;
}

@Injectable({
  providedIn: 'root'
})
export class TransactionsService {
  private apiUrl = 'http://localhost:8080/api';

  constructor(private http: HttpClient) {}

  getTransactions(page: number, filters?: any): Observable<any> {
    const params: any = { page, ...filters };
    return this.http.get(`${this.apiUrl}/transactions`, { params });
  }

  addTransaction(transaction: Transaction): Observable<Transaction> {
    return this.http.post<Transaction>(`${this.apiUrl}/transactions`, transaction);
  }

  getTransactionById(id: number): Observable<Transaction>{
    return this.http.get<Transaction>(`${this.apiUrl}/transactions/${id}`);
  }

  deleteTransaction(id: number): Observable<Transaction> {
    return this.http.delete<Transaction>(`${this.apiUrl}/transactions/${id}`);
  }

  editTransaction(id: number, transaction: Transaction): Observable<Transaction> {
    return this.http.put<Transaction>(`${this.apiUrl}/transactions/${id}`, transaction);
  }

}
