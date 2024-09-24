import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IEmpleado } from 'src/app/interfaces/empleados';
import { IRol } from 'src/app/interfaces/roles';
import { EmpleadosService } from 'src/app/services/empleados.service';
import { RolesService } from 'src/app/services/roles.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';
import * as bcrypt from 'bcryptjs';

@Component({
  selector: 'app-nuevo-empleado',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-empleado.component.html',
  styleUrl: './nuevo-empleado.component.scss'
})
export class NuevoEmpleadoComponent {

  private empleadoService = inject(EmpleadosService);
  private rolService = inject(RolesService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Empleado';
  idEmpleado: number = 0;
  nombreBoton = 'Guardar';
  listaRoles: IRol[] = [];

  originalPassword: string;
  hashedPassword: string;

  form_Empleado = new FormGroup({
    cedula: new FormControl('', Validators.required),
    nombre: new FormControl('', Validators.required),
    correo: new FormControl('', Validators.required),
    clave: new FormControl('', Validators.required),
    id_rol: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idEmpleado = parseInt(this.ruta.snapshot.paramMap.get('id'));
    this.cargarDatos();
    if (this.idEmpleado > 0) {
      this.empleadoService.uno(this.idEmpleado).subscribe(data => {
        this.form_Empleado.controls['cedula'].setValue(data.cedula);
        this.form_Empleado.controls['nombre'].setValue(data.nombre);
        this.form_Empleado.controls['correo'].setValue(data.correo);
        this.form_Empleado.controls['clave'].setValue(data.clave);
        this.form_Empleado.controls['id_rol'].setValue(data.id_rol.toString());
      });


      this.tituloPantalla = 'Modificar Empleado';
      this.nombreBoton = 'Modificar';
    }
  }

  cargarDatos() {
    this.rolService.todos().subscribe({
      next: (data) => {
        this.listaRoles = data;
      },
      error: (error) => {
        console.error(error);
      }
    });
  }

  guardar() {

    const salt = bcrypt.genSaltSync(10); // Genera un salt
    this.hashedPassword = bcrypt.hashSync(this.form_Empleado.value.clave, salt);

    let empleado: IEmpleado = {
      id_empleado: this.idEmpleado,
      cedula: this.form_Empleado.value.cedula,
      nombre: this.form_Empleado.value.nombre,
      correo: this.form_Empleado.value.correo,
      clave: this.hashedPassword,
      id_rol: parseInt(this.form_Empleado.value.id_rol)
    }

    Swal.fire({
      title: 'Empleados',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idEmpleado > 0) {
          this.empleadoService.actualizar(empleado).subscribe((data: any) => {
            Swal.fire({
              title: 'Empleados',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/empleados']);
          });
        } else {
          this.empleadoService.insertar(empleado).subscribe((data: any) => {
            Swal.fire({
              title: 'Empleados',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/empleados']);
          });
        }
      }
    });

  }

  seleccionarRol(event: any) {
    this.form_Empleado.controls['id_rol'].setValue(event.target.value)
  }

}
