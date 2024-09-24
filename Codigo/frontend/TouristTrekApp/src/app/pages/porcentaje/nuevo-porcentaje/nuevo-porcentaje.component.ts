import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IPorcentajeGanancia } from 'src/app/interfaces/porcentaje-ganancia';
import { PorcentajesService } from 'src/app/services/porcentajes.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-porcentaje',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-porcentaje.component.html',
  styleUrl: './nuevo-porcentaje.component.scss'
})
export class NuevoPorcentajeComponent {

  private porcentajeService = inject(PorcentajesService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Porcentaje';
  idPorcentaje: number = 0;
  nombreBoton = 'Guardar';

  form_Porcentaje = new FormGroup({
    descripcion: new FormControl('', Validators.required),
    valor: new FormControl('', [Validators.required, Validators.pattern('^[0-9]*$'), Validators.maxLength(2)]),
    estado: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idPorcentaje = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idPorcentaje > 0) {
      this.porcentajeService.uno(this.idPorcentaje).subscribe(data => {
        this.form_Porcentaje.controls['descripcion'].setValue(data.descripcion);
        this.form_Porcentaje.controls['valor'].setValue(data.valor.toString());
        this.form_Porcentaje.controls['estado'].setValue(data.estado.toString());
      });


      this.tituloPantalla = 'Modificar Porcentaje';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar() {
    let porcentajeganancia: IPorcentajeGanancia = {
      id_porcentajeganancia: this.idPorcentaje,
      descripcion: this.form_Porcentaje.value.descripcion,
      valor: parseInt(this.form_Porcentaje.value.valor),
      estado: parseInt(this.form_Porcentaje.value.estado)
    }

    Swal.fire({
      title: 'Porcentaje',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idPorcentaje > 0) {
          this.porcentajeService.actualizar(porcentajeganancia).subscribe((data: any) => {
            Swal.fire({
              title: 'Porcentaje',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/porcentaje']);
          });
        } else {
          this.porcentajeService.insertar(porcentajeganancia).subscribe((data: any) => {
            Swal.fire({
              title: 'Porcentaje',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/porcentaje']);
          });
        }
      }
    });

  }

  valorEstado(event: any) {
    this.form_Porcentaje.controls['estado'].setValue(event.target.value);
  }

}
