import { HttpClient } from '@angular/common/http';
import { inject, Injectable } from '@angular/core';
import { IEstadoReserva } from '../interfaces/estados-reserva';

@Injectable({
  providedIn: 'root'
})
export class EstadosReservaService {

  apiurl = 'http://localhost/proyectointegradorsexto/Codigo/backend/controllers/estadosreserva.controller.php?op=';

  private http = inject(HttpClient);
  
  constructor() { }

  todos(){
    return this.http.get<IEstadoReserva[]>(this.apiurl + 'todos');
  }
}
