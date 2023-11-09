import { Component } from '@angular/core';
import { UsersServicesService } from '../services/users.services.service';
import { StorageService } from '../services/storage.service';
import { User } from '../models/user';

@Component({
  selector: 'app-home',
  templateUrl: 'home.page.html',
  styleUrls: ['home.page.scss'],
})
export class HomePage {
  email = '';
  password = '';
  errorMessage = '';
  registrationSuccessMessage = '';
  isLoggedIn = false;

  newUser: User = {
    username: '',
    lastname: '',
    email: '',
    password: '',
  };

  isLoginView = true;

  constructor(private usersServicesService: UsersServicesService, private localStorage: StorageService) { }

  ngOnInit() {
    const isLoggedIn = this.localStorage.getItem('isLoggedIn');
    this.isLoggedIn = isLoggedIn === 'true';
    console.log('isLoggedIn:', this.isLoggedIn);
    console.log('isLoginView:', this.isLoginView);
  }  
  toggleView() {
    this.isLoginView = !this.isLoginView;
    this.errorMessage = '';
    this.registrationSuccessMessage = '';
  }
     
  login() {
    if (this.isLoginView) {
      const loginData = {
        email: this.email,
        password: this.password
      };

      this.usersServicesService.login(loginData).subscribe(
        (response: any) => {
          this.localStorage.setItem('isLoggedIn', 'true');
          this.isLoggedIn = true;
        },
        (error: any) => {
          this.errorMessage = 'Login failed. Please try again.';
        }
      );
    }
  }

  register() {
    if (!this.newUser.email) {
      this.errorMessage = 'Email is required.';
      return;
    }

    this.usersServicesService.createUser(this.newUser).subscribe(
      (response: any) => {
        this.registrationSuccessMessage = 'Registration successful. You can now log in.';
        this.newUser = { username: '', lastname: '', email: '', password: '' };
        this.errorMessage = '';
      },
      (error: any) => {
        this.errorMessage = 'Error during registration. Please try again.';
      }
    );
  }

  logout() {
    this.localStorage.removeItem('isLoggedIn');
    this.isLoggedIn = false;
    this.errorMessage = '';
    this.registrationSuccessMessage = '';
  }
}
