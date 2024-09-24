import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IEmpleado } from '../interfaces/empleados';
import { BehaviorSubject, Observable } from 'rxjs';
import { Router } from '@angular/router';

@Injectable({
  providedIn: 'root'
})
export class EmpleadosService {

  private loggedIn = new BehaviorSubject<boolean>(false);

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/empleados.controller.php?op=';

  private http = inject(HttpClient);
  private navegacion = inject(Router);

  
  constructor() { }

  todos(){
    return this.http.get<IEmpleado[]>(this.apiurl + 'todos');
  }

  uno(id_empleado: number): Observable<IEmpleado> {
    const formData = new FormData();
    formData.append('id_empleado', id_empleado.toString());
    return this.http.post<IEmpleado>(this.apiurl + 'uno', formData);
  }

  insertar(empleado: IEmpleado): Observable<string> {
    const formData = new FormData();
    formData.append('cedula', empleado.cedula);
    formData.append('nombre', empleado.nombre);
    formData.append('correo', empleado.correo);
    formData.append('clave', empleado.clave);
    formData.append('id_rol', empleado.id_rol.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(empleado: IEmpleado): Observable<string> {
    const formData = new FormData();
    formData.append('id_empleado', empleado.id_empleado.toString());
    formData.append('cedula', empleado.cedula);
    formData.append('nombre', empleado.nombre);
    formData.append('correo', empleado.correo);
    formData.append('clave', empleado.clave);
    formData.append('id_rol', empleado.id_rol.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_empleado: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_empleado', id_empleado.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

  login(empleado: IEmpleado) {
    let formData = new FormData();
    formData.append('cedula', empleado.cedula);
    formData.append('clave', empleado.clave);

    return this.http.post<any>(this.apiurl + 'login', formData).subscribe((respuesta) => {
      if (respuesta.success == 'true' || respuesta.id_empleado > 0) {
        
        sessionStorage.setItem('nombreUsuario', respuesta.nombre);
        // sessionStorage.setItem('rolesIdRoles', respuesta.Roles_idRoles.toString());
        localStorage.setItem('rolesIdRoles', respuesta.id_rol.toString());
        this.loggedIn.next(true);
        this.navegacion.navigate(['/dashboard/default']);
      } else {
        console.log(respuesta);
        // this.navegacion.navigate(['/login/' + respuesta.error]);
        this.navegacion.navigate(['/login/']);
      }
    });
  }

  logout() {
    sessionStorage.clear();
    localStorage.clear();
    this.navegacion.navigate(['/login']);
  }

  isLoggedIn() {
    return this.loggedIn.asObservable();
  }

  checkLoginStatus() {
    const usuario = sessionStorage.getItem('id_rol');
    if (parseInt(usuario) > 0) {
      this.loggedIn.next(true);
    }
  }
}

