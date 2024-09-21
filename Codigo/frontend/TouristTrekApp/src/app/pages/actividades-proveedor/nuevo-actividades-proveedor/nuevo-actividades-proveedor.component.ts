import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { IActividad } from 'src/app/interfaces/actividades';
import { IActividadProveedor } from 'src/app/interfaces/actividades-proveedor';
import { IProveedor } from 'src/app/interfaces/proveedores';
import { ActividadesProveedorService } from 'src/app/services/actividades-proveedor.service';
import { ActividadesService } from 'src/app/services/actividades.service';
import { ProveedoresService } from 'src/app/services/proveedores.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-actividades-proveedor',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-actividades-proveedor.component.html',
  styleUrl: './nuevo-actividades-proveedor.component.scss'
})
export class NuevoActividadesProveedorComponent {

  private actividadesProveedorService = inject(ActividadesProveedorService);
  private actividadService = inject(ActividadesService);
  private proveedorService = inject(ProveedoresService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Actividades por Proveedor';
  idActividadProveedor: number = 0;
  nombreBoton = 'Guardar';
  listaActividades: IActividad[] = [];
  listaProveedores: IProveedor[] = [];

  form_ActividadProveedor = new FormGroup({
    tarifa_adultos: new FormControl('', [Validators.required, Validators.pattern(/^\d+(\.\d{1,2})?$/)]),
    tarifa_ninos: new FormControl('', [Validators.required, Validators.pattern(/^\d+(\.\d{1,2})?$/)]),
    tarifa_extranjero: new FormControl('', [Validators.required, Validators.pattern(/^\d+(\.\d{1,2})?$/)]),
    id_actividad: new FormControl('', Validators.required),
    id_proveedor: new FormControl('', Validators.required)
  });

  constructor() { }

  ngOnInit(): void {
    this.idActividadProveedor = parseInt(this.ruta.snapshot.paramMap.get('id'));

    if (this.idActividadProveedor > 0) {
      this.actividadesProveedorService.uno(this.idActividadProveedor).subscribe(data => {
        this.form_ActividadProveedor.controls['tarifa_adultos'].setValue(data.tarifa_adultos.toString());
        this.form_ActividadProveedor.controls['tarifa_ninos'].setValue(data.tarifa_ninos.toString());
        this.form_ActividadProveedor.controls['tarifa_extranjero'].setValue(data.tarifa_extranjero.toString());
        this.form_ActividadProveedor.controls['id_actividad'].setValue(data.id_actividad.toString());
        this.form_ActividadProveedor.controls['id_proveedor'].setValue(data.id_proveedor.toString());
      });

      this.tituloPantalla = 'Modificar Actividad por Proveedor';
      this.nombreBoton = 'Modificar';
    }

    this.cargarActividades();
    this.cargarProveedores();
  }

  cargarActividades() {
    this.actividadService.todos().subscribe(data => {
      this.listaActividades = data;
    });
  }

  cargarProveedores() {
    this.proveedorService.todos().subscribe(data => {
      this.listaProveedores = data;
    });
  }

  guardar(){
    let actividadproveedor: IActividadProveedor = {
      idactividades_proveedor: this.idActividadProveedor,
      tarifa_adultos: parseFloat(this.form_ActividadProveedor.value.tarifa_adultos),
      tarifa_ninos: parseFloat(this.form_ActividadProveedor.value.tarifa_ninos),
      tarifa_extranjero: parseFloat(this.form_ActividadProveedor.value.tarifa_extranjero),
      id_actividad: parseInt(this.form_ActividadProveedor.value.id_actividad),
      id_proveedor: parseInt(this.form_ActividadProveedor.value.id_proveedor)
    }

    Swal.fire({
      title: 'Actividad por Proveedor',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idActividadProveedor > 0) {
          this.actividadesProveedorService.actualizar(actividadproveedor).subscribe(data => {
            Swal.fire({
              title: 'Actividad por Proveedor',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/actividades-proveedor']);
          });
        } else {
          this.actividadesProveedorService.insertar(actividadproveedor).subscribe(data => {
            Swal.fire({
              title: 'Actividad por Proveedor',
              text: 'Guardado exitoso',
              icon: 'success'
            });
            this.navegacion.navigate(['/actividades-proveedor']);
          });
        }
      }
    });

  }

  seleccionarIdActividad(event: any) {
    console.log('Secuencial', event.target.value);
    let idActividad = event.target.value;
    this.form_ActividadProveedor.get('id_actividad')?.setValue(idActividad);
  }

  seleccionarIdProveedor(event: any) {
    console.log('Secuencial', event.target.value);
    let idProveedor = event.target.value;
    this.form_ActividadProveedor.get('id_proveedor')?.setValue(idProveedor);
  }

}
