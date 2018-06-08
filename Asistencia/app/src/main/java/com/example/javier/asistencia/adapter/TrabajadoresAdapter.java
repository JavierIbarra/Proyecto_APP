package com.example.javier.asistencia.adapter;

import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.TextView;

import com.example.javier.asistencia.R;
import com.example.javier.asistencia.entidades.Trabajadores;

import java.util.List;

public class TrabajadoresAdapter extends RecyclerView.Adapter<TrabajadoresAdapter.TrabajadoresHolder> {

    List<Trabajadores> ListaTrabajadores;

    public TrabajadoresAdapter(List<Trabajadores> ListaTrabajadores){
        this.ListaTrabajadores=ListaTrabajadores;
    }

    @Override
    public TrabajadoresHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View vista= LayoutInflater.from(parent.getContext()).inflate(R.layout.trabajadores_list,parent,false);
        RecyclerView.LayoutParams layoutParams=new RecyclerView.LayoutParams(ViewGroup.LayoutParams.MATCH_PARENT,
                ViewGroup.LayoutParams.WRAP_CONTENT);
        vista.setLayoutParams(layoutParams);
        return new TrabajadoresHolder(vista);
    }

    @Override
    public void onBindViewHolder(TrabajadoresHolder holder, int position) {
        holder.email.setText(ListaTrabajadores.get(position).getEmail().toString());
        holder.name.setText(ListaTrabajadores.get(position).getName().toString());
    }

    @Override
    public int getItemCount() {
        return ListaTrabajadores.size();
    }


    public class TrabajadoresHolder extends RecyclerView.ViewHolder {

        TextView name,email;

        public TrabajadoresHolder(View itemView) {
            super(itemView);
            name= (TextView) itemView.findViewById(R.id.name);
            email= (TextView) itemView.findViewById(R.id.email);
        }
    }
}
