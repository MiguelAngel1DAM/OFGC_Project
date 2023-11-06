import { Component } from '@angular/core';
import { HomeServicesService } from '../services/home.services.service';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
  username = '';
  password = '';
  lastname = '';
  errorMessage = '';
  registrationSuccessMessage = '';
  isLoggedIn = false;

  newUser = {
    username: '',
    lastname: '',
    email: '',
    password: '',    
  };

  isLoginView = true;

  constructor(private homeServicesService: HomeServicesService) {}

  ngOnInit() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    this.isLoggedIn = isLoggedIn === 'true';
  }

  toggleView() {
    this.isLoginView = !this.isLoginView;
    this.errorMessage = '';
    this.registrationSuccessMessage = '';
  }

  login() {
    if (this.isLoginView) {
      const loginPayload = {
        username: this.username,
        password: this.password
      };

      this.homeServicesService.authenticateUser(loginPayload).subscribe(
        (response: any) => {
          this.isLoggedIn = true;
          this.errorMessage = '';

          localStorage.setItem('isLoggedIn', 'true');
        },
        (error: any) => {
          this.errorMessage = 'Credenciales incorrectas. Por favor, inténtalo de nuevo.';
        }
      );
    }
  }

  register() {
    if (!this.newUser.email) {
      this.errorMessage = 'Email is required.';
      return;
    }
  
    this.homeServicesService.createUser(this.newUser).subscribe(
      (response: any) => {
        this.registrationSuccessMessage = 'Registro exitoso. Ahora puedes iniciar sesión.';
        this.newUser = {
          username: '',
          lastname: '',
          email: '',
          password: '', 
        };
        this.errorMessage = '';
      },
      (error: any) => {
        this.errorMessage = 'Error durante el registro. Por favor, inténtalo de nuevo.';
      }
    );
  }

  logout() {
    localStorage.removeItem('isLoggedIn');
    this.isLoggedIn = false;
    this.errorMessage = '';
    this.registrationSuccessMessage = '';
  }
}
