import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';
import { HttpClient } from '@angular/common/http';

@Injectable({
  providedIn: 'root',
})
export class Api {
  private apiUrl = environment.apiUrl;

  constructor(
    private http: HttpClient,
  ){}

  get(endpoint: string) {
    return this.http.get(`${this.apiUrl}/${endpoint}`);
  }

  post(endpoint: string, data: any) {
    return this.http.post(`${this.apiUrl}/${endpoint}`, data);
  }

  put(endpoint: string, data: any) {
    return this.http.put(`${this.apiUrl}/${endpoint}`, data);
  }

  delete(endpoint: string) {
    return this.http.delete(`${this.apiUrl}/${endpoint}`);
  }
}
