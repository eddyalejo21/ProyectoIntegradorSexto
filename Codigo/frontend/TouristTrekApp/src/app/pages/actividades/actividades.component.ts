import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IActividad } from 'src/app/interfaces/actividades';
import { ActividadesService } from 'src/app/services/actividades.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-actividades',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './actividades.component.html',
  styleUrl: './actividades.component.scss'
})
export class ActividadesComponent {

  private actividadService = inject(ActividadesService);

  title = 'Lista de Actividades';
  listaActividades: IActividad[] = [];

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

  eliminar(id_actividad: number) {
    Swal.fire({
      title: 'Actividad',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.actividadService.eliminar(id_actividad).subscribe((data) => {
          Swal.fire('Actividad', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
