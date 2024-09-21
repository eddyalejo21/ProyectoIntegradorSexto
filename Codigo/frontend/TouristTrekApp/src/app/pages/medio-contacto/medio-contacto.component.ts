import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { IMedioContacto } from 'src/app/interfaces/medio-contacto';
import { MedioContactoService } from 'src/app/services/medio-contacto.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-medio-contacto',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './medio-contacto.component.html',
  styleUrl: './medio-contacto.component.scss'
})
export class MedioContactoComponent {

  private medioContactoService = inject(MedioContactoService);

  title = 'Lista de Medio de Contacto';
  listaMediosContacto: IMedioContacto[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.medioContactoService.todos().subscribe({
      next: (data) => {
        this.listaMediosContacto = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_mediocontacto: number) {
    Swal.fire({
      title: 'Medio de Contacto',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.medioContactoService.eliminar(id_mediocontacto).subscribe((data) => {
          Swal.fire('Medio de Contacto', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
