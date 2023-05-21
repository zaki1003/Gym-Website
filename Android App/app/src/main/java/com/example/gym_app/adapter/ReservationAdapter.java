package com.example.gym_app.adapter;

import android.view.LayoutInflater;
import android.view.View;
import android.widget.TextView;
import androidx.appcompat.app.AppCompatActivity;
import androidx.recyclerview.widget.RecyclerView;
import com.example.gym_app.R;
import android.view.ViewGroup;
import android.content.Context;
import com.example.gym_app.model.Reservation;
import com.example.gym_app.model.UserData;
import java.util.List;


public class ReservationAdapter  extends RecyclerView.Adapter<ReservationAdapter.ReservationViewHolder> {


    private List<Reservation> dataList;
    private Context context;
    private AppCompatActivity activity;
    private String token;
    public ReservationAdapter(Context context,List<Reservation> dataList,String token,AppCompatActivity activity){
        this.context = context;
        this.dataList = dataList;
        this.token = token;
        this.activity=activity;
    }

    class ReservationViewHolder extends RecyclerView.ViewHolder {

        public final View mView;

        TextView session_name,session_date,reservation_date,reservation_time,user_name;


        ReservationViewHolder(View itemView) {
            super(itemView);
            mView = itemView;

            session_name = mView.findViewById(R.id.session_name);
            session_date = mView.findViewById(R.id.session_date);
            reservation_date = mView.findViewById(R.id.reservation_date);
            reservation_time = mView.findViewById(R.id.reservation_time);
            user_name = mView.findViewById(R.id.user_name);
        }
    }

    @Override
    public ReservationViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        LayoutInflater layoutInflater = LayoutInflater.from(parent.getContext());
        View view = layoutInflater.inflate(R.layout.resevation_raw, parent, false);

        return new ReservationViewHolder(view);
    }


    @Override
    public void onBindViewHolder(ReservationViewHolder holder, int position) {

        UserData x = UserData.getInstance();
        String   role = x.role;


        holder.session_name.setText("Nom de la séance: "+dataList.get(position).getTraining_session_name());
        holder.session_date.setText("Date de la séance: "+dataList.get(position).getTraining_session_date());
        holder.reservation_date.setText("Date de la réservation: "+dataList.get(position).getReservation_date());
        holder.reservation_time.setText("Heure de réservation: "+dataList.get(position).getReservation_time());
        holder.user_name.setText("Nom de l'utilisateur: "+dataList.get(position).getName());





    }

       /* Picasso.Builder builder = new Picasso.Builder(context);
        builder.downloader(new OkHttp3Downloader(context));
        builder.build().load(dataList.get(position).getThumbnailUrl())
                .placeholder((R.drawable.ic_launcher_background))
                .error(R.drawable.ic_launcher_background)
                .into(holder.coverImage);
*/


    @Override
    public int getItemCount() {
        return dataList.size();
    }
}
