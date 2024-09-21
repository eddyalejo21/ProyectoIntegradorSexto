import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IActividad } from 'src/app/interfaces/actividades';
import { ITipoActividad } from 'src/app/interfaces/tipo-actividad';
import { ActividadesService } from 'src/app/services/actividades.service';
import { TipoActividadService } from 'src/app/services/tipo-actividad.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nueva-actividad',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nueva-actividad.component.html',
  styleUrl: './nueva-actividad.component.scss'
})
export class NuevaActividadComponent {

  private actividadService = inject(ActividadesService);
  private tipoActividadService = inject(TipoActividadService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Actividad';
  idActividad: number = 0;
  nombreBoton = 'Guardar';
  listaTipoActividad: ITipoActividad[] = [];

  form_Actividad = new FormGroup({
    nombre: new FormControl('', Validators.required),
    descripcion: new FormControl('', Validators.required),
    id_tipoactividad: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idActividad = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idActividad > 0) {
      this.actividadService.uno(this.idActividad).subscribe(data => {
        this.form_Actividad.controls['nombre'].setValue(data.nombre);
        this.form_Actividad.controls['descripcion'].setValue(data.descripcion);
        this.form_Actividad.controls['id_tipoactividad'].setValue(data.id_tipoactividad.toString());
    });

    this.tituloPantalla = 'Modificar Medio de Contacto';
    this.nombreBoton = 'Modificar';
  }

    this.cargarTipoActividad();
  }

cargarTipoActividad() {
  this.tipoActividadService.todos().subscribe(data => {
    this.listaTipoActividad = data;
  });
}

guardar(){
  let actividad: IActividad = {
    id_actividad: this.idActividad,
    nombre: this.form_Actividad.value.nombre,
    descripcion: this.form_Actividad.value.descripcion,
    id_tipoactividad: parseInt(this.form_Actividad.value.id_tipoactividad)
  }

  Swal.fire({
    title: 'Actividades',
    text: '¿Está seguro que los datos ingresados son correctos?',
    icon: 'info',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Si, Guardar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      if (this.idActividad > 0) {
        this.actividadService.actualizar(actividad).subscribe(data => {
          Swal.fire({
            title: 'Actividades',
            text: 'Actualización exitosa',
            icon: 'success'
          });
          this.navegacion.navigate(['/actividades']);
        });
      } else {
        this.actividadService.insertar(actividad).subscribe(data => {
          Swal.fire({
            title: 'Actividades',
            text: 'Guardado exitoso',
            icon: 'success'
          });
          this.navegacion.navigate(['/actividades']);
        });
      }
    }
  });
}

cambio(event: any) {
  console.log('Secuencial', event.target.value);
  let idTipoActividad = event.target.value;
  this.form_Actividad.get('id_tipoactividad')?.setValue(idTipoActividad);
}




}
