using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

using System.IO;
using System.Drawing.Imaging;
using System.Drawing;

namespace WindowsFormsApplication21
{
    class clsImagen
    {
        public static MemoryStream ByteToImage(byte [] array)
        {
            MemoryStream ms = new MemoryStream();
            return ms;
        }

        public static byte [] imageToByte(Image imageIn)
        {
            MemoryStream ms = new MemoryStream();
            imageIn.Save(ms, ImageFormat.Jpeg);

            return ms.ToArray();

        }

    }
}
