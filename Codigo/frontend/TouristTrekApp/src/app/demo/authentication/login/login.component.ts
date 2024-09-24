// angular import
import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { RouterModule } from '@angular/router';
import { IEmpleado } from 'src/app/interfaces/empleados';
import { EmpleadosService } from 'src/app/services/empleados.service';

@Component({
  selector: 'app-login',
  standalone: true,
  imports: [RouterModule, ReactiveFormsModule],
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export default class LoginComponent {

  private empleadoService = inject(EmpleadosService);
  
  form_InicioSesion = new FormGroup({
    cedula: new FormControl('', Validators.required),
    clave: new FormControl('', Validators.required)
  });

  constructor() { }

  iniciarSesion() { 
    let empleado: IEmpleado = {
      cedula: this.form_InicioSesion.value.cedula,
      clave: this.form_InicioSesion.value.clave
    }

    this.empleadoService.login(empleado);
  }


}
