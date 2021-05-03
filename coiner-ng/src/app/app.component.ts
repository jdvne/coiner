import { Component } from '@angular/core';
import { Order } from './order';

import { HttpClient, HttpErrorResponse, HttpParams } from '@angular/common/http';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  // dependency injection
  constructor(private http: HttpClient) { }

  title = 'Contact Us';
  subtitle = "Please enter your contact information below";

  confirm_msg = '';
  data_submitted = '';

  /* create an instance of an Order, assuming there is an existent order */
  orderModel = new Order('', '', '', '', false);

  confirmOrder(data: any): void {
     console.log(data);
     this.confirm_msg = 'Thank you, ' + data.name + '(' + data.name.length + ')';
     this.confirm_msg += '. You ordered ' + data.drink_option;
  }

  responsedata = new Order("", "", "", "", false);

  // function for form submission to php backend
  onSubmit(form: any): void {
    this.data_submitted = form;

    // convert the form data to JSON format
    let params = JSON.stringify(form);

     // send an HTTP POST request to the backend
     this.http.post<Order>('http://localhost/coiner/ng-post.php', params)
        .subscribe((response_from_php) => {
            // set local variable on php response
            this.responsedata = response_from_php;
        }, (error_in_comm) => {
            // error, notify the user
            console.log("An error occurred in form submission. Please refresh the page and retry. ", error_in_comm);
        });

  }
}
