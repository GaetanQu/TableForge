import { Component, inject } from '@angular/core';
import { ReactiveFormsModule, Validators, FormBuilder} from '@angular/forms';

import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css'],
})
export class LoginComponent {

  private fb = inject(FormBuilder)
  invalidCredentials:boolean = false;

  private router = inject(Router)

  private auth = inject(AuthService)

  loginForm = this.fb.nonNullable.group({
    username: this.fb.nonNullable.control('', Validators.required),
    password: this.fb.nonNullable.control('', Validators.required),
    rememberMe: false,
  });

  onLogin() {
  if (this.loginForm.invalid) {
    this.loginForm.markAllAsTouched();
    return;
  }

  const { username, password, rememberMe } = this.loginForm.getRawValue();

  this.auth.login({ username, password }, rememberMe).subscribe({
    next: (data:any) => {
      this.auth.saveToken(data.token, rememberMe);
      this.router.navigate(['']);
    },
    error: (err:any) => {
      console.error('Erreur lors de la connexion :', err);
      this.invalidCredentials = true;
    },
  });
}
}
