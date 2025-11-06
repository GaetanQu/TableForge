import { Component } from '@angular/core';
import {FormGroup, FormControl, ReactiveFormsModule} from '@angular/forms';

import { AuthService } from '../../services/auth.service';

@Component({
  selector: 'app-login',
  imports: [ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrl: './login.component.css',
})
export class LoginComponent {

  public constructor(
    private auth: AuthService,
  ){}

  loginForm = new FormGroup({
    username: new FormControl(''),
    password: new FormControl(''),
  })
}
