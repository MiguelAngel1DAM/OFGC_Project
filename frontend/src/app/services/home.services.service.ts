import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';

const endpoint = 'http://127.0.0.1:8000/api/Users';

@Injectable({
  providedIn: 'root'
})


export class HomeServicesService {
  constructor(private http: HttpClient) { }

  authenticateUser(credentials: { username: string; password: string }) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded'
    });

    const bodyEncoded = new URLSearchParams();
    bodyEncoded.set('username', credentials.username);
    bodyEncoded.set('password', credentials.password);
    
    console.log("Log de usuario")
    console.log(bodyEncoded.toString())

    return this.http.post(`${endpoint}/login`, bodyEncoded.toString(), { headers });
  }

  getAllUsers() {
    return this.http.get(endpoint);
  }

  getUserById(userId: number) {
    console.log("Log de usuario")
    console.log(userId)
    return this.http.get(`${endpoint}/${userId}`);
  }

  createUser(user: any) {
    const headers = new HttpHeaders({
      'Content-Type': 'application/x-www-form-urlencoded'
    });

    console.log("Log de usuario")
    console.log(user)

    const bodyEncoded = new URLSearchParams();
    bodyEncoded.append('Icon', "prueba.jpg");
    bodyEncoded.append('name', user.username);
    bodyEncoded.append('lastname', user.lastname);
    bodyEncoded.append('password', user.password);
    bodyEncoded.append('email', user.email);

    console.log(bodyEncoded.toString())

    return this.http.post(endpoint, bodyEncoded.toString(), { headers });
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
