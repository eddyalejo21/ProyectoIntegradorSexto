import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { ICliente } from 'src/app/interfaces/clientes';
import { ClientesService } from 'src/app/services/clientes.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-clientes',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './clientes.component.html',
  styleUrl: './clientes.component.scss'
})
export class ClientesComponent {

  private clienteService = inject(ClientesService);

  title = 'Lista de Clientes';
  listaClientes: ICliente[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.clienteService.todos().subscribe({
      next: (data) => {
        this.listaClientes = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_cliente: number) {
    Swal.fire({
      title: 'Clientes',
      text: 'Esta seguro que desea eliminar el registro',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Eliminar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        this.clienteService.eliminar(id_cliente).subscribe((data) => {
          Swal.fire('Clientes', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
}
