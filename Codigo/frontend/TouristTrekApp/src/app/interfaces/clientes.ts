export interface ICliente {
    id_cliente?: number;
    identificacion?: string;
    nombre?: string;
    fecha_nacimiento?: string;
    genero?: string;
    correo?: string;
    telefono?: string;
    clave?: string;
    token?: number;
    id_tipocliente?: number;
    estado?: number;
    id_pais?: number;
}