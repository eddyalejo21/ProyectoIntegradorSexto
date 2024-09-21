import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IPais } from '../interfaces/paises';

@Injectable({
  providedIn: 'root'
})
export class PaisesService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/paises.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IPais[]>(this.apiurl + 'todos');
  }
}
