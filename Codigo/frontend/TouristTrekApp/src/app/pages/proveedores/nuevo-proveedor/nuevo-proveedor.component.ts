import { CommonModule } from '@angular/common';
import { Component, inject, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, FormsModule, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IProveedor } from 'src/app/interfaces/proveedores';
import { ProveedoresService } from 'src/app/services/proveedores.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-proveedor',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-proveedor.component.html',
  styleUrl: './nuevo-proveedor.component.scss'
})
export class NuevoProveedorComponent implements OnInit {

  private proveedorService = inject(ProveedoresService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Proveedor';
  idProveedor: number = 0;
  nombreBoton = 'Guardar';

  form_Proveedor = new FormGroup({
    nombre_empresa: new FormControl('', Validators.required),
    nombre_representante: new FormControl('', Validators.required),
    direccion: new FormControl('', Validators.required),
    telefono_principal: new FormControl('', [Validators.required, Validators.pattern('^[0-9]*$'), Validators.maxLength(10)]),
    telefono_secundario: new FormControl('', [Validators.pattern('^[0-9]*$'), Validators.maxLength(10)]),
    correo: new FormControl('', [Validators.required, Validators.email])
  });

  constructor() { }

  ngOnInit(): void {
    this.idProveedor = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idProveedor > 0) {
      this.proveedorService.uno(this.idProveedor).subscribe(data => {
        this.form_Proveedor.controls['nombre_empresa'].setValue(data.nombre_empresa);
        this.form_Proveedor.controls['nombre_representante'].setValue(data.nombre_representante);
        this.form_Proveedor.controls['direccion'].setValue(data.direccion);
        this.form_Proveedor.controls['telefono_principal'].setValue(data.telefono_principal);
        this.form_Proveedor.controls['telefono_secundario'].setValue(data.telefono_secundario);
        this.form_Proveedor.controls['correo'].setValue(data.correo);
      });


      this.tituloPantalla = 'Modificar Proveedor';
      this.nombreBoton = 'Modificar';
    }
  }

  guardar() {
    let proveedor: IProveedor = {
      id_proveedor: this.idProveedor,
      nombre_empresa: this.form_Proveedor.value.nombre_empresa,
      nombre_representante: this.form_Proveedor.value.nombre_representante,
      direccion: this.form_Proveedor.value.direccion,
      telefono_principal: this.form_Proveedor.value.telefono_principal,
      telefono_secundario: this.form_Proveedor.value.telefono_secundario,
      correo: this.form_Proveedor.value.correo
    }

    Swal.fire({
      title: 'Proveedores',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3053d6',
      cancelButtonColor: '#e41d1d',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idProveedor > 0) {
          this.proveedorService.actualizar(proveedor).subscribe((data: any) => {
            Swal.fire({
              title: 'Proveedores',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/proveedores']);
          });
        } else {
          this.proveedorService.insertar(proveedor).subscribe((data: any) => {
            Swal.fire({
              title: 'Proveedores',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/proveedores']);
          });
        }
      }
    });

  }



}
