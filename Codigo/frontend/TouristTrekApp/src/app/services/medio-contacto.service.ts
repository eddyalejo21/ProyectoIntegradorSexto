import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IMedioContacto } from '../interfaces/medio-contacto';
import { Observable } from 'rxjs';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class MedioContactoService {

  //apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/mediocontacto.controller.php?op=';
  apiurl = environment.baseURL + environment.apiURL + 'mediocontacto.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IMedioContacto[]>(this.apiurl + 'todos');
  }

  uno(id_mediocontacto: number): Observable<IMedioContacto> {
    const formData = new FormData();
    formData.append('id_mediocontacto', id_mediocontacto.toString());
    return this.http.post<IMedioContacto>(this.apiurl + 'uno', formData);
  }

  insertar(mediocontacto: IMedioContacto): Observable<string> {
    const formData = new FormData();
    formData.append('nombre', mediocontacto.nombre);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(mediocontacto: IMedioContacto): Observable<string> {
    const formData = new FormData();
    formData.append('id_mediocontacto', mediocontacto.id_mediocontacto.toString());
    formData.append('nombre', mediocontacto.nombre);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_mediocontacto: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_mediocontacto', id_mediocontacto.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
