import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IActividadProveedor } from '../interfaces/actividades-proveedor';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ActividadesProveedorService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/actividadesproveedor.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IActividadProveedor[]>(this.apiurl + 'todosJoin');
  }

  uno(idactividades_proveedor: number): Observable<IActividadProveedor> {
    const formData = new FormData();
    formData.append('idactividades_proveedor', idactividades_proveedor.toString());
    return this.http.post<IActividadProveedor>(this.apiurl + 'uno', formData);
  }

  insertar(actividadesproveedor: IActividadProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('tarifa_adultos', actividadesproveedor.tarifa_adultos.toString());
    formData.append('tarifa_ninos', actividadesproveedor.tarifa_ninos.toString());
    formData.append('tarifa_extranjero', actividadesproveedor.tarifa_extranjero.toString());
    formData.append('id_proveedor', actividadesproveedor.id_proveedor.toString());
    formData.append('id_actividad', actividadesproveedor.id_actividad.toString());
    return this.http.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(actividadesproveedor: IActividadProveedor): Observable<string> {
    const formData = new FormData();
    formData.append('idactividades_proveedor', actividadesproveedor.idactividades_proveedor.toString());
    formData.append('tarifa_adultos', actividadesproveedor.tarifa_adultos.toString());
    formData.append('tarifa_ninos', actividadesproveedor.tarifa_ninos.toString());
    formData.append('tarifa_extranjero', actividadesproveedor.tarifa_extranjero.toString());
    formData.append('id_proveedor', actividadesproveedor.id_proveedor.toString());
    formData.append('id_actividad', actividadesproveedor.id_actividad.toString());
    return this.http.post<string>(this.apiurl + 'actualizar', formData);
  }

  eliminar(idactividades_proveedor: number): Observable<number> {
    const formData = new FormData();
    formData.append('idactividades_proveedor', idactividades_proveedor.toString());
    return this.http.post<number>(this.apiurl + 'eliminar', formData);
  }

}
