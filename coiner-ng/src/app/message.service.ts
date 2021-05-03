import { Injectable } from '@angular/core';
import { Message } from './message';

import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class MessageService {
  temp_message = new Message("", "", "", "", false);

  // dependency injection
  constructor(private http: HttpClient) { }

  // send a request to the backend
  sendRequest(data: any): Observable<any> {
    return this.http.post<any>('http://localhost/coiner/ng-post.php', data);
  }

  processMessage(data: any): Observable<any> {
    // process data here?
    return this.sendRequest(data);
  }
}
