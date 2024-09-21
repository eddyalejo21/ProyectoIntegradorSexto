import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ITipoActividad } from 'src/app/interfaces/tipo-actividad';
import { TipoActividadService } from 'src/app/services/tipo-actividad.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-tipo-actividad',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-tipo-actividad.component.html',
  styleUrl: './nuevo-tipo-actividad.component.scss'
})
export class NuevoTipoActividadComponent {

  private tipoActividadService = inject(TipoActividadService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Tipo Actividad';
  idTipoActividad: number = 0;
  nombreBoton = 'Guardar';

  form_TipoActividad = new FormGroup({
    nombre: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idTipoActividad = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idTipoActividad > 0) {
      this.tipoActividadService.uno(this.idTipoActividad).subscribe(data => {
        this.form_TipoActividad.controls['nombre'].setValue(data.nombre);
      });

      this.tituloPantalla = 'Modificar Tipo Actividad';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar(){
    let tipoactividad: ITipoActividad = {
      id_tipoactividad: this.idTipoActividad,
      nombre: this.form_TipoActividad.value.nombre
    }

    Swal.fire({
      title: 'Tipo de Actividad',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idTipoActividad > 0) {
          this.tipoActividadService.actualizar(tipoactividad).subscribe(data => {
            Swal.fire({
              title: 'Tipo de Cliente',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/tipo-actividad']);
          });
        } else {
          this.tipoActividadService.insertar(tipoactividad).subscribe(data => {
            Swal.fire({
              title: 'Tipo de Cliente',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/tipo-actividad']);
          });
        }
      }
    });

  }

}
