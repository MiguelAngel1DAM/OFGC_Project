import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';
import { User } from '../models/user';

const endpoint = 'http://127.0.0.1:8000/api/Users';

@Injectable({
  providedIn: 'root'
})

export class UsersServicesService {
  constructor(private http: HttpClient) { }

  getAllUsers(): Observable<User[]> {
    return this.http.get<User[]>(endpoint);
  }

  createUser(user: any) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded',
    });
  
    const bodyEncoded = new URLSearchParams();
    bodyEncoded.append('Icon', 'prueba.jpg');
    bodyEncoded.append('name', user.username);
    bodyEncoded.append('lastname', user.lastname);
    bodyEncoded.append('password', user.password);
    bodyEncoded.append('email', user.email);
  
    return this.http.post(endpoint, bodyEncoded.toString(), { headers });
  }
  

  registerUser(user: any) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded'
    });

    return this.http.post(endpoint, user, { headers });
  }

  login(loginData: any) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded'
    });

    const bodyEncoded = new URLSearchParams();
    bodyEncoded.append('email', loginData.email);
    bodyEncoded.append('password', loginData.password);

    return this.http.post(`${endpoint}/login`, bodyEncoded.toString(), { headers });
  }

  updateUser(userId: number, userData: any) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded'
    });

    const formData = new URLSearchParams();
    for (const key in userData) {
      if (userData.hasOwnProperty(key)) {
        formData.set(key, userData[key]);
      }
    }

    return this.http.put(`${endpoint}/${userId}`, formData.toString(), { headers });
  }

  deleteUser(userId: number) {
    return this.http.delete(`${endpoint}/${userId}`);
  }

}
