import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class StorageService {

  setItem(Key: string, value: any): void {
    localStorage.setItem(Key, JSON.stringify(value));
  }

  getItem(Key: string):any{
    const value = localStorage.getItem(Key);
    return value ? JSON.parse(value) : null;
  }

  removeItem(Key: string):void {
    localStorage.removeItem(Key);
  }
}
