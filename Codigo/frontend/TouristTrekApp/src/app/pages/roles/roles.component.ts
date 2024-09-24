import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IRol } from 'src/app/interfaces/roles';
import { RolesService } from 'src/app/services/roles.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-roles',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './roles.component.html',
  styleUrl: './roles.component.scss'
})
export class RolesComponent {

  private rolService = inject(RolesService);

  title = 'Lista de Roles';
  listaRoles: IRol[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.rolService.todos().subscribe({
      next: (data) => {
        this.listaRoles = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_rol: number) {
    Swal.fire({
      title: 'Roles',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.rolService.eliminar(id_rol).subscribe((data) => {
          Swal.fire('Roles', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
