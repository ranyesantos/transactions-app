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
  private apiUrl = 'http://127.0.0.1:8000/api';

  constructor(private http: HttpClient) {}

  getTransactions(page: number, filters?: any): Observable<PaginatedResponse> {
    const params: any = { page, ...filters };
    return this.http.get<PaginatedResponse>(`${this.apiUrl}/transactions`, { params });
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
