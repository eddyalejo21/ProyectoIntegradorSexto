import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IRol } from '../interfaces/roles';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class RolesService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/roles.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IRol[]>(this.apiurl + 'todos');
  }

  uno(id_rol: number): Observable<IRol> {
    const formData = new FormData();
    formData.append('id_rol', id_rol.toString());
    return this.http.post<IRol>(this.apiurl + 'uno', formData);
  }

  insertar(rol: IRol): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', rol.nombre);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(rol: IRol): Observable<string> {
    const formData = new FormData();
    formData.append('id_rol', rol.id_rol.toString());
    formData.append('nombre', rol.nombre);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_rol: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_rol', id_rol.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
