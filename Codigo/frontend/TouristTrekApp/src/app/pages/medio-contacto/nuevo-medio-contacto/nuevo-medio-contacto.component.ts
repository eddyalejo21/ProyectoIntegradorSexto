import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IMedioContacto } from 'src/app/interfaces/medio-contacto';
import { MedioContactoService } from 'src/app/services/medio-contacto.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-medio-contacto',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-medio-contacto.component.html',
  styleUrl: './nuevo-medio-contacto.component.scss'
})
export class NuevoMedioContactoComponent {

  private medioContactoService = inject(MedioContactoService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Medio de Contacto';
  idMedioContacto: number = 0;
  nombreBoton = 'Guardar';

  form_MedioContacto = new FormGroup({
    nombre: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idMedioContacto = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idMedioContacto > 0) {
      this.medioContactoService.uno(this.idMedioContacto).subscribe(data => {
        this.form_MedioContacto.controls['nombre'].setValue(data.nombre);
      });

      this.tituloPantalla = 'Modificar Medio de Contacto';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar(){
    let mediocontacto: IMedioContacto = {
      id_mediocontacto: this.idMedioContacto,
      nombre: this.form_MedioContacto.value.nombre
    }

    Swal.fire({
      title: 'Medio de Contacto',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idMedioContacto > 0) {
          this.medioContactoService.actualizar(mediocontacto).subscribe(data => {
            Swal.fire({
              title: 'Medio de Contacto',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/medio-contacto']);
          });
        } else {
          this.medioContactoService.insertar(mediocontacto).subscribe(data => {
            Swal.fire({
              title: 'Medio de Contacto',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/medio-contacto']);
          });
        }
      }
    });

  }

}
