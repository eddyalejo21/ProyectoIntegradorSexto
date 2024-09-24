import { Component, inject } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { ICliente } from 'src/app/interfaces/clientes';
import { IContactoCliente } from 'src/app/interfaces/contactos-cliente';
import { IMedioContacto } from 'src/app/interfaces/medio-contacto';
import { IPais } from 'src/app/interfaces/paises';
import { ITipoCliente } from 'src/app/interfaces/tipo-cliente';
import { ClientesService } from 'src/app/services/clientes.service';
import { ContactosClienteService } from 'src/app/services/contactos-cliente.service';
import { MedioContactoService } from 'src/app/services/medio-contacto.service';
import { PaisesService } from 'src/app/services/paises.service';
import { TipoClienteService } from 'src/app/services/tipo-cliente.service';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-nuevo-cliente',
  standalone: true,
  imports: [SharedModule, ReactiveFormsModule],
  templateUrl: './nuevo-cliente.component.html',
  styleUrl: './nuevo-cliente.component.scss'
})
export class NuevoClienteComponent {

  private clienteService = inject(ClientesService);
  private paisService = inject(PaisesService);
  private tipoClienteService = inject(TipoClienteService);
  private medioContactoService = inject(MedioContactoService);
  private contactoClienteService = inject(ContactosClienteService);
  private ruta = inject(ActivatedRoute);
  private navegacion = inject(Router);

  tituloPantalla = 'Registrar Cliente';
  idCliente: number = 0;
  nombreBoton = 'Guardar';

  listaPaises: IPais[] = [];
  listaTiposCliente: ITipoCliente[] = [];
  listaMediosContacto: IMedioContacto[] = [];
  checkboxSeleccionado: boolean = false;
  // listaMediosContactoSeleccion: any = [];

  form_Cliente = new FormGroup({
    identificacion: new FormControl('', Validators.required),
    nombre: new FormControl('', Validators.required),
    fecha_nacimiento: new FormControl('', Validators.required),
    genero: new FormControl('', Validators.required),
    correo: new FormControl('', Validators.required),
    telefono: new FormControl('', Validators.required),
    clave: new FormControl(''),
    token: new FormControl(''),
    id_tipocliente: new FormControl('', Validators.required),
    estado: new FormControl(''),
    id_pais: new FormControl('', Validators.required)
  });

  form_ContactosCliente = new FormGroup({
    id_mediocontacto: new FormControl(''),
    id_cliente: new FormControl('')
  });

  constructor() { }

  ngOnInit(): void {
    this.idCliente = parseInt(this.ruta.snapshot.paramMap.get('id'));

    this.cargarPaises();
    this.cargarTipoCliente();
    this.cargarMediosContacto();

    if (this.idCliente > 0) {
      this.clienteService.uno(this.idCliente).subscribe(data => {
        this.form_Cliente.controls['identificacion'].setValue(data.identificacion);
        this.form_Cliente.controls['nombre'].setValue(data.nombre);
        this.form_Cliente.controls['fecha_nacimiento'].setValue(data.fecha_nacimiento.toString());
        this.form_Cliente.controls['genero'].setValue(data.genero);
        this.form_Cliente.controls['correo'].setValue(data.correo);
        this.form_Cliente.controls['telefono'].setValue(data.telefono);
        this.form_Cliente.controls['clave'].setValue(data.clave);
        this.form_Cliente.controls['token'].setValue(data.token.toString());
        this.form_Cliente.controls['id_tipocliente'].setValue(data.id_tipocliente.toString());
        this.form_Cliente.controls['estado'].setValue(data.estado.toString());
        this.form_Cliente.controls['id_pais'].setValue(data.id_pais.toString());
      });

      // this.medioContactoService.mediosSeleccion(this.idCliente).subscribe(data => {
      //   data.forEach(element => {
      //     console.log(element.id_mediocontacto);
      //     if (element.id_mediocontacto != null) {
      //       console.log('Existe numero');
      //       this.checkboxSeleccionado = true;
      //     }
      //   });               
      // });

      this.medioContactoService.mediosSeleccion(this.idCliente).subscribe(data => {
        const listaObjetos: string[] = [];
        this.listaMediosContacto.forEach(elemento => {
          listaObjetos.push(elemento.id_mediocontacto.toString());
        });
        console.log(listaObjetos);

        data.forEach(objeto =>{
          if(listaObjetos.includes(objeto.id_mediocontacto.toString())){
            console.log('Existe numero');
            console.log(document.getElementById('checkbox' + objeto.id_mediocontacto) as HTMLInputElement); 
          }
        });



      });

      this.tituloPantalla = 'Modificar Medio de Contacto';
      this.nombreBoton = 'Modificar';
    }
  }


  cargarPaises() {
    this.paisService.todos().subscribe(data => {
      this.listaPaises = data;
    });
  }

  cargarTipoCliente() {
    this.tipoClienteService.todos().subscribe(data => {
      this.listaTiposCliente = data;
    });
  }

  cargarMediosContacto() {
    this.medioContactoService.todos().subscribe(data => {
      this.listaMediosContacto = data;
    });
  }

  guardar() {
    const randomToken = Math.floor(100000 + Math.random() * 900000); // Generación de un token de 6 digitos aleatorio

    let cliente: ICliente = {
      id_cliente: this.idCliente,
      identificacion: this.form_Cliente.value.identificacion,
      nombre: this.form_Cliente.value.nombre,
      fecha_nacimiento: this.form_Cliente.value.fecha_nacimiento,
      genero: this.form_Cliente.value.genero,
      correo: this.form_Cliente.value.correo,
      telefono: this.form_Cliente.value.telefono,
      clave: this.form_Cliente.value.clave,
      token: randomToken,
      id_tipocliente: parseInt(this.form_Cliente.value.id_tipocliente),
      estado: 1,
      id_pais: parseInt(this.form_Cliente.value.id_pais)
    }

    Swal.fire({
      title: 'Cliente',
      text: '¿Está seguro que los datos ingresados son correctos?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, Guardar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.idCliente > 0) {
          this.clienteService.actualizar(cliente).subscribe(data => {
            Swal.fire({
              title: 'Cliente',
              text: 'Actualización exitosa',
              icon: 'success'
            });
            this.navegacion.navigate(['/clientes']);
          });
        } else {
          this.clienteService.insertar(cliente).subscribe(data => {

            //Ingresa a recorrer el listado de medios de contacto para insertar 
            const checkboxes = document.querySelectorAll<HTMLInputElement>('input[type="checkbox"]:checked');
            checkboxes.forEach((checkbox) => {

              let contactoscliente: IContactoCliente = {
                id_mediocontacto: parseInt(checkbox.value),
                id_cliente: parseInt(data)
              }

              this.contactoClienteService.insertar(contactoscliente).subscribe(resp => {
                Swal.fire({
                  title: 'Cliente',
                  text: 'Guardado exitoso',
                  icon: 'success'
                });
                this.navegacion.navigate(['/clientes']);
              });
            });
          });
        }
      }
    });

  }

  valorPais(event: any) {
    this.form_Cliente.controls['id_pais'].setValue(event.target.value);
  }

  valorTipoCliente(event: any) {
    this.form_Cliente.controls['id_tipocliente'].setValue(event.target.value);
  }


}
