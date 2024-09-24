import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IPorcentajeGanancia } from 'src/app/interfaces/porcentaje-ganancia';
import { PorcentajesService } from 'src/app/services/porcentajes.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-porcentaje',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './porcentaje.component.html',
  styleUrl: './porcentaje.component.scss'
})
export class PorcentajeComponent {

  private porcentajesService = inject(PorcentajesService);

  title = 'Lista de Proveedores';
  listaPorcentajes: IPorcentajeGanancia[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.porcentajesService.todos().subscribe({
      next: (data) => {
        this.listaPorcentajes = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_porcentajeganancia: number) {
    Swal.fire({
      title: 'Proveedores',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.porcentajesService.eliminar(id_porcentajeganancia).subscribe((data) => {
          Swal.fire('Porcentaje', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
