package com.example.javier.asistencia.interfaces;

import android.support.design.widget.NavigationView;

import com.example.javier.asistencia.AssistanceFragment;
import com.example.javier.asistencia.ListParticipantsFragment;
import com.example.javier.asistencia.MapFragment;

public interface IFragment extends ListParticipantsFragment.OnFragmentInteractionListener,
        AssistanceFragment.OnFragmentInteractionListener,
        MapFragment.OnFragmentInteractionListener{
}
