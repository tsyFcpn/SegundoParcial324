using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Drawing.Imaging;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using System.Data.SqlClient;
using System.IO;

namespace WindowsFormsApplication21
{
    public partial class Form1 : Form
    {
        int cR, cG, cB;
        int cR1, cG1, cB1;
        int cR2, cG2, cB2;
        int cR3, cG3, cB3;
        string cadena_con = "Data Source=LAPTOP-N6IQG5II\\MSSQLSERVER01;Initial Catalog=db; Integrated Security=True";
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            openFileDialog1.ShowDialog();
            Bitmap bmp = new Bitmap(openFileDialog1.FileName);
            pictureBox1.Image = bmp;
        }

        private void button8_Click(object sender, EventArgs e)
        {
            ConsultaImagen();
        }

        private void button2_Click(object sender, EventArgs e)
        {
            textBox1.Text = "";
            textBox2.Text = "";
            textBox3.Text = "";
        }

        private void pictureBox1_MouseClick(object sender, MouseEventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Color c = new Color();
            int x, y, mR = 0, mG = 0, mB = 0;
            x = e.X; y = e.Y;
            for (int i = x; i < x + 10; i++)
                for (int j = y; j < y + 10; j++)
                {
                    c = bmp.GetPixel(i, j);
                    mR = mR + c.R;
                    mG = mG + c.G;
                    mB = mB + c.B;
                }
            mR = mR / 100;
            mG = mG / 100;
            mB = mB / 100;
            cR = mR;
            cG = mG;
            cB = mB;
            textBox1.Text = cR.ToString();
            textBox2.Text = cG.ToString();
            textBox3.Text = cB.ToString();
        }

        private void button3_Click(object sender, EventArgs e)
        {
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 1; i < bmp.Width; i++)
                for (int j = 1; j < bmp.Height; j++)
                {
                    c = bmp.GetPixel(i, j);
                    cpoa.SetPixel(i, j, c);
                }
            pictureBox2.Image = cpoa;
        }

        private void button4_Click(object sender, EventArgs e)
        {
            textBox6.Text = textBox1.Text;
            textBox4.Text = textBox2.Text;
            textBox5.Text = textBox3.Text;

            cR1 = Int32.Parse(textBox6.Text.ToString());
            cG1 = Int32.Parse(textBox4.Text.ToString());
            cB1 = Int32.Parse(textBox5.Text.ToString());

        }

        private void button5_Click(object sender, EventArgs e)
        {
            textBox9.Text = textBox1.Text;
            textBox8.Text = textBox2.Text;
            textBox7.Text = textBox3.Text;
            cR2 = Int32.Parse(textBox9.Text.ToString());
            cG2 = Int32.Parse(textBox8.Text.ToString());
            cB2 = Int32.Parse(textBox7.Text.ToString());
        }


        private void button6_Click(object sender, EventArgs e)
        {
            textBox12.Text = textBox1.Text;
            textBox11.Text = textBox2.Text;
            textBox10.Text = textBox3.Text;
            cR3 = Int32.Parse(textBox12.Text.ToString());
            cG3 = Int32.Parse(textBox11.Text.ToString());
            cB3 = Int32.Parse(textBox10.Text.ToString());
        }

        private void button7_Click(object sender, EventArgs e)
        {
            SqlConnection con = new SqlConnection(cadena_con);
            SqlCommand cmd = new SqlCommand();

            cmd.CommandText = "INSERT INTO imagenes(Imagen1, Imagen2) VALUES (@imagen1,@imagen2)";
            cmd.Parameters.Add("@imagen1", SqlDbType.Image).Value = clsImagen.imageToByte(pictureBox1.Image);

            int meR, meG, meB;
            Bitmap bmp = new Bitmap(pictureBox1.Image);
            Bitmap cpoa = new Bitmap(bmp.Width, bmp.Height);
            Color c = new Color();
            for (int i = 0; i < bmp.Width - 10; i += 10)
                for (int j = 0; j < bmp.Height - 10; j += 10)
                {
                    meR = 0;
                    meG = 0;
                    meB = 0;

                    for (int k = i; k < i + 10; k++)
                        for (int l = j; l < j + 10; l++)
                        {
                            c = bmp.GetPixel(k, l);
                            meR = meR + c.R;
                            meG = meG + c.G;
                            meB = meB + c.B;
                        }
                    meR = meR / 100;
                    meG = meG / 100;
                    meB = meB / 100;

                    if ((((cR1 - 10) < meR) && (meR < (cR1 + 10)) && ((cG1 - 10) < meG) && (meG < (cG1 + 10)) && ((cB1 - 10) < meB) && (meB < (cB1 + 10)))
                        || (((cR2 - 10) < meR) && (meR < (cR2 + 10)) && ((cG2 - 10) < meG) && (meG < (cG2 + 10)) && ((cB2 - 10) < meB) && (meB < (cB2 + 10)))
                        || (((cR3 - 10) < meR) && (meR < (cR3 + 10)) && ((cG3 - 10) < meG) && (meG < (cG3 + 10)) && ((cB3 - 10) < meB) && (meB < (cB3 + 10))))
                    {
                        if ((((cR1 - 10) < meR) && (meR < (cR1 + 10)) && ((cG1 - 10) < meG) && (meG < (cG1 + 10)) && ((cB1 - 10) < meB) && (meB < (cB1 + 10))))
                        {
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Lime);
                                }
                        }
                        else if ((((cR2 - 10) < meR) && (meR < (cR2 + 10)) && ((cG2 - 10) < meG) && (meG < (cG2 + 10)) && ((cB2 - 10) < meB) && (meB < (cB2 + 10))))
                        {
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Magenta);
                                }
                        }
                        else if ((((cR3 - 10) < meR) && (meR < (cR3 + 10)) && ((cG3 - 10) < meG) && (meG < (cG3 + 10)) && ((cB3 - 10) < meB) && (meB < (cB3 + 10))))
                        {
                            for (int k = i; k < i + 10; k++)
                                for (int l = j; l < j + 10; l++)
                                {
                                    cpoa.SetPixel(k, l, Color.Cyan);
                                }
                        }
                    }
                    else
                    {
                        for (int k = i; k < i + 10; k++)
                            for (int l = j; l < j + 10; l++)
                            {
                                c = bmp.GetPixel(k, l);
                                cpoa.SetPixel(k, l, c);
                            }
                    }

                }

            pictureBox2.Image = cpoa;



            cmd.Parameters.Add("@imagen2", SqlDbType.Image).Value = clsImagen.imageToByte(pictureBox2.Image);
            cmd.CommandType = CommandType.Text;
            cmd.Connection = con;
            con.Open();
            cmd.ExecuteNonQuery();
            con.Close();
        }
        protected void ConsultaImagen()
        {
            SqlConnection con = new SqlConnection(cadena_con);
            con.Open();
            SqlCommand cmd = new SqlCommand("SELECT imagen1, imagen2 FROM imagenes ORDER BY ID ASC", con);
            SqlDataAdapter sd = new SqlDataAdapter(cmd);     
            DataTable dt = new DataTable();
            sd.Fill(dt);
            dataGridView1.DataSource = dt;
            con.Close();
            dataGridView1.AutoSizeRowsMode = DataGridViewAutoSizeRowsMode.AllCells;           
        }
    }
}
