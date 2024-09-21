import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ITipoCliente } from 'src/app/interfaces/tipo-cliente';
import { TipoClienteService } from 'src/app/services/tipo-cliente.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-tipo-cliente',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './tipo-cliente.component.html',
  styleUrl: './tipo-cliente.component.scss'
})
export class TipoClienteComponent {
 
  private tipoClienteService = inject(TipoClienteService);

  title = 'Lista de Tipos de Clientes';
  listaTipoClientes: ITipoCliente[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.tipoClienteService.todos().subscribe({
      next: (data) => {
        this.listaTipoClientes = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_tipocliente: number) {
    Swal.fire({
      title: 'Tipo de Cliente',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.tipoClienteService.eliminar(id_tipocliente).subscribe((data) => {
          Swal.fire('Tipo De Cliente', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
