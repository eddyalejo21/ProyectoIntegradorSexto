import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IActividad } from 'src/app/interfaces/actividades';
import { ActividadesService } from 'src/app/services/actividades.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';

@Component({
  selector: 'app-actividades',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './actividades.component.html',
  styleUrl: './actividades.component.scss'
})
export class ActividadesComponent {

  private actividadesService = inject(ActividadesService);

  title = 'Lista de Actividades';
  listaActividades: IActividad[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarTabla();
  }
  
  cargarTabla() {
    this.actividadesService.todos().subscribe((data) => {
      this.listaActividades = data;
    });
  }

  eliminar(id_actividad: number) {
    this.actividadesService.eliminar(id_actividad).subscribe((data) => {
      this.cargarTabla();
    });
  }
}
