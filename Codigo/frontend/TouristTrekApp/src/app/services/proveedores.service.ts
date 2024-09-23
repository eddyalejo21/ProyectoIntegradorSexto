import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { Observable } from 'rxjs';
import { IProveedor } from '../interfaces/proveedores';
import { environment } from 'src/environments/environment';

@Injectable({
  providedIn: 'root'
})
export class ProveedoresService {

  //apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/proveedores.controller.php?op=';
  apiurl = environment.baseURL + environment.apiURL + 'proveedores.controller.php?op=';
  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IProveedor[]>(this.apiurl + 'todos');
  }

  uno(id_proveedor: number): Observable<IProveedor> {
    const formData = new FormData();
    formData.append('id_proveedor', id_proveedor.toString());
    return this.http.post<IProveedor>(this.apiurl + 'uno', formData);
  }

  insertar(proveedor: IProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('nombre_empresa', proveedor.nombre_empresa);
    formData.append('nombre_representante', proveedor.nombre_representante);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono_principal', proveedor.telefono_principal);
    formData.append('telefono_secundario', proveedor.telefono_secundario);
    formData.append('correo', proveedor.correo);
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(proveedor: IProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('id_proveedor', proveedor.id_proveedor.toString());
    formData.append('nombre_empresa', proveedor.nombre_empresa);
    formData.append('nombre_representante', proveedor.nombre_representante);
    formData.append('direccion', proveedor.direccion);
    formData.append('telefono_principal', proveedor.telefono_principal);
    formData.append('telefono_secundario', proveedor.telefono_secundario);
    formData.append('correo', proveedor.correo);
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(id_proveedor: number): Observable<number> {
    const formData = new FormData();
    formData.append('id_proveedor', id_proveedor.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }
}
