import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ITipoActividad } from 'src/app/interfaces/tipo-actividad';
import { TipoActividadService } from 'src/app/services/tipo-actividad.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-tipo-actividad',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './tipo-actividad.component.html',
  styleUrl: './tipo-actividad.component.scss'
})
export class TipoActividadComponent {

  private tipoActividadService = inject(TipoActividadService);

  title = 'Lista de Tipos de Actividades';
  listaTipoActividades: ITipoActividad[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.tipoActividadService.todos().subscribe({
      next: (data) => {
        this.listaTipoActividades = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_tipoactividad: number) {
    Swal.fire({
      title: 'Tipo de Actividad',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.tipoActividadService.eliminar(id_tipoactividad).subscribe((data) => {
          Swal.fire('Tipo De Actividad', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }

}

