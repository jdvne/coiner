import { Component } from '@angular/core';
import { Message } from './message';

import { MessageService } from "./message.service";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {

  // dependency injection
  constructor(private messageService: MessageService) { }

  title = 'Contact Us';

  confirm_msg = '';
  data_submitted = '';
  submitted = false;

  /* create an instance of an Order, assuming there is an existent order */
  messageModel = new Message('Joshua Devine', 'jdd9kr@virginia.edu', 'Subject', 'Message', false);

  confirmMessage(data: any): void {
    this.confirm_msg = 'Thank you for reaching out';
    if (!data.anonymous) this.confirm_msg += ", " + data.name;
  }

  responsedata = new Message("", "", "", "", false);

  // function for form submission to php backend
  onSubmit(form: any): void {
    this.data_submitted = form;
    this.submitted = true;

    // convert the form data to JSON format
    let params = JSON.stringify(form);

    // send an HTTP POST request to the backend
    this.messageService.processMessage(params)
      .subscribe((response_from_php) => {
          // set local variable on php response
          this.responsedata = response_from_php;
      }, (error_in_comm) => {
          // error, notify the user
          console.log("An error occurred in form submission. Please refresh the page and retry. ", error_in_comm);
      });

  }
}
