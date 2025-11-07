import { Component, inject } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-landing-page',
  imports: [],
  templateUrl: './landing-page.component.html',
  styleUrl: './landing-page.component.css',
})
export class LandingPageComponent {
  private auth = inject(AuthService);
  private router = inject (Router)

  onLogout() {
    this.auth.logout();
    this.router.navigate(['login'])
  }
}
