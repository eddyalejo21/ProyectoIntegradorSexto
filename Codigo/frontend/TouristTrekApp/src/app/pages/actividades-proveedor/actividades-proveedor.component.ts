import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IActividadProveedor } from 'src/app/interfaces/actividades-proveedor';
import { ActividadesProveedorService } from 'src/app/services/actividades-proveedor.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-actividades-proveedor',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './actividades-proveedor.component.html',
  styleUrl: './actividades-proveedor.component.scss'
})
export class ActividadesProveedorComponent {

  
  private actividadesProveedorService = inject(ActividadesProveedorService);

  title = 'Lista de Actividades por Proveedor';
  listaActividadesProveedor: IActividadProveedor[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.actividadesProveedorService.todos().subscribe({
      next: (data) => {
        this.listaActividadesProveedor = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(idactividades_proveedor: number) {
    Swal.fire({
      title: 'Actividad por Proveedor',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.actividadesProveedorService.eliminar(idactividades_proveedor).subscribe((data) => {
          Swal.fire('Actividad por Proveedor', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }

}
