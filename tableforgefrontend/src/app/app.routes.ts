import { Routes } from '@angular/router';
import { LandingPageComponent } from './components/landing-page.component/landing-page.component'
import { LoginComponent } from './components/login.component/login.component';
import { AuthGuard } from './guards/auth.guard';

export const routes: Routes = [
    {
        path: '',
        component: LandingPageComponent,
        canActivate: [AuthGuard],
        children: [

        ]
    },
    {
        path: 'login',
        component: LoginComponent
    },
];
