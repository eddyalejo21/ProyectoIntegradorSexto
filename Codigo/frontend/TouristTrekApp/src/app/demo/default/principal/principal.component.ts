import { Component, inject } from '@angular/core';
import { IActividad } from 'src/app/interfaces/actividades';
import { ActividadesService } from 'src/app/services/actividades.service';

@Component({
  selector: 'app-principal',
  standalone: true,
  imports: [],
  templateUrl: './principal.component.html',
  styleUrl: './principal.component.scss'
})


export class PrincipalComponent {

  private actividadService = inject(ActividadesService);

  listaActividades: IActividad[] = [];

  pathImagenes = 'https://raw.githubusercontent.com/Edisonsll44/img-proyecto-integrador/refs/heads/main/';
  extension = '.jpg';
  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.actividadService.todos().subscribe({
      next: (data) => {
        this.listaActividades = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }
}
