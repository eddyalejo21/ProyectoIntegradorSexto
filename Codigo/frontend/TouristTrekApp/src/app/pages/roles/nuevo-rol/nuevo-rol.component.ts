import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IRol } from 'src/app/interfaces/roles';
import { RolesService } from 'src/app/services/roles.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-rol',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-rol.component.html',
  styleUrl: './nuevo-rol.component.scss'
})
export class NuevoRolComponent {

  private rolService = inject(RolesService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Rol';
  idRol: number = 0;
  nombreBoton = 'Guardar';

  form_Rol = new FormGroup({
    nombre: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idRol = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idRol > 0) {
      this.rolService.uno(this.idRol).subscribe(data => {
        this.form_Rol.controls['nombre'].setValue(data.nombre);
      });


      this.tituloPantalla = 'Modificar Rol';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar() {
    let rol: IRol = {
      id_rol: this.idRol,
      nombre: this.form_Rol.value.nombre
    }

    Swal.fire({
      title: 'Roles',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idRol > 0) {
          this.rolService.actualizar(rol).subscribe((data: any) => {
            Swal.fire({
              title: 'Roles',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/roles']);
          });
        } else {
          this.rolService.insertar(rol).subscribe((data: any) => {
            Swal.fire({
              title: 'Roles',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/roles']);
          });
        }
      }
    });

  }

}
