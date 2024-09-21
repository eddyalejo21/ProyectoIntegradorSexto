import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ITipoCliente } from 'src/app/interfaces/tipo-cliente';
import { TipoClienteService } from 'src/app/services/tipo-cliente.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-tipo-cliente',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-tipo-cliente.component.html',
  styleUrl: './nuevo-tipo-cliente.component.scss'
})
export class NuevoTipoClienteComponent {

  private tipoClienteService = inject(TipoClienteService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Tipo Cliente';
  idTipoCliente: number = 0;
  nombreBoton = 'Guardar';

  form_TipoCliente = new FormGroup({
    nombre: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idTipoCliente = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idTipoCliente > 0) {
      this.tipoClienteService.uno(this.idTipoCliente).subscribe(data => {
        this.form_TipoCliente.controls['nombre'].setValue(data.nombre);
      });

      this.tituloPantalla = 'Modificar Tipo de Cliente';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar() {
    let tipocliente: ITipoCliente = {
      id_tipocliente: this.idTipoCliente,
      nombre: this.form_TipoCliente.value.nombre
    }

    Swal.fire({
      title: 'Tipo de Cliente',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idTipoCliente > 0) {
          this.tipoClienteService.actualizar(tipocliente).subscribe((data: any) => {
            Swal.fire({
              title: 'Tipo de Cliente',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/tipo-cliente']);
          });
        } else {
          this.tipoClienteService.insertar(tipocliente).subscribe((data: any) => {
            Swal.fire({
              title: 'Tipo de Cliente',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/tipo-cliente']);
          });
        }
      }
    });
  }

}
