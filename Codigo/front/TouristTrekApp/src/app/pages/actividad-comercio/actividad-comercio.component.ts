import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IActividadComercio } from 'src/app/interfaces/actividades-comercio';
import { ActividadComercioService } from 'src/app/services/actividad-comercio.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-actividad-comercio',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './actividad-comercio.component.html',
  styleUrl: './actividad-comercio.component.scss'
})
export class ActividadComercioComponent {
 
  private actividadComercioService = inject(ActividadComercioService);

  title = 'Lista de Actividades por Comercio';
  listaActividadesComercio: IActividadComercio[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarTabla();
  }
  
  cargarTabla() {
    this.actividadComercioService.todosJoin().subscribe((data) => {
      this.listaActividadesComercio = data;
    });
  }

  eliminar(id_actividadcomercio: number) {
    this.actividadComercioService.eliminar(id_actividadcomercio).subscribe((data) => {
      this.cargarTabla();
    });
  }
}
