import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule } from '@angular/forms';

import { AppComponent } from './app.component';
import { TransactionsListComponent } from './components/transactions-list/transactions-list.component';
import { TransactionNewComponent } from './components/transaction-new/transaction-new.component';
import { TransactionDetailsComponent } from './components/transaction-details/transaction-details.component';
import { TransactionEditComponent } from './components/transaction-edit/transaction-edit.component';

const routes: Routes = [
  { path: '', redirectTo: '/transactions', pathMatch: 'full' },
  { path: 'transactions', component: TransactionsListComponent },
  { path: 'transaction-new', component: TransactionNewComponent },
  { path: 'transaction/:id', component: TransactionDetailsComponent },
  { path: 'transaction/edit/:id', component: TransactionEditComponent }
];


@NgModule({
  declarations: [
    AppComponent,
    TransactionsListComponent,
    TransactionNewComponent,
    TransactionDetailsComponent,
    TransactionEditComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    RouterModule.forRoot(routes),
    FormsModule
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
