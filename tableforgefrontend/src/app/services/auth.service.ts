import { Injectable } from '@angular/core';
import { LoginDTO } from '../dtos/login.dto';
import { Api } from './api.service';

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private tokenKey = 'auth_token';

  public constructor(
    private api: Api,
  ){}

  getToken(): string | null {
    return localStorage.getItem(this.tokenKey);
  }

  isAuthenticated(): boolean {
    return !!this.getToken();
  }

  saveToken(token: string) {
    localStorage.setItem(this.tokenKey, token);
  }

  login(data:LoginDTO) {
    this.api.post('login', data)
  }

  logout() {
    localStorage.removeItem(this.tokenKey);
  }
}
