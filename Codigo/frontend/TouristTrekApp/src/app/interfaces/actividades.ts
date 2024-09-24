export interface IActividad {
    id_actividad?: number;
    nombre?: string;
    descripcion?: string;
    id_tipoactividad?: number;
    nombreTipo?: string;
};
export interface IImagenActividad {
    id_actividad?: number;
    nombre?: string;
    descripcion?: string;
    id_tipoactividad?: number;
    idimagenes:number;
    path?: string;
};