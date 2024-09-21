import { Component, inject, OnInit } from '@angular/core';
import { Router, RouterLink } from '@angular/router';
import { IProveedor } from 'src/app/interfaces/proveedores';
import { ProveedoresService } from 'src/app/services/proveedores.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-proveedores',
  standalone: true,
  imports: [SharedModule, RouterLink],
  templateUrl: './proveedores.component.html',
  styleUrl: './proveedores.component.scss'
})
export class ProveedoresComponent implements OnInit {

  private proveedorService = inject(ProveedoresService);

  title = 'Lista de Proveedores';
  listaProveedores: IProveedor[] = [];

  constructor() { }

  ngOnInit(): void {
    this.cargarDatos();
  }

  cargarDatos() {
    this.proveedorService.todos().subscribe({
      next: (data) => {
        this.listaProveedores = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  eliminar(id_proveedor: number) {
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
        this.proveedorService.eliminar(id_proveedor).subscribe((data) => {
          Swal.fire('Proveedores', 'El registro ha sido eliminado.', 'success');
          this.cargarDatos();
        });
      }
    });
  }
  
}
