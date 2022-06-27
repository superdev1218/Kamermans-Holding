import React, { useContext, useEffect} from "react";
import {connect} from 'react-redux';
import {Link} from 'react-router-dom';
import {ActivateState,ActivateTransferState,GetOrder, CreatePayment, GetPaymentResult} from "../../../redux/actions/wallet"
import PropTypes from "prop-types";
import {
    withStyles,
    withWidth,
    Button,
    FormControl,
    Select,
    MenuItem,
    CircularProgress
} from "@material-ui/core";
import { LanguageContext } from '../../../utils/Language';
import Typography from "@material-ui/core/Typography";
import Grid from "@material-ui/core/Grid";
import Dialog from "@material-ui/core/Dialog";
import DialogContentText from "@material-ui/core/DialogContentText";
import {DialogTitle, DialogActions, DialogContent} from "../Dialog";
import Collapse from "@material-ui/core/Collapse";
import { useHistory } from "react-router-dom";
import { setItem } from '../../../utils/helper';

let myInterval, pay_id;

function SavingComponent(props) {
    const {
        classes,hide,amount,user_id,activateState,activate,orderId, paymentInfo, paymentResult
    } = props;

    const { dictionary } = useContext(LanguageContext);

    const [savingActivate, setSavingActivate] = React.useState(activate);
    const [activeModalOpen, setActiveModalOpen] = React.useState(false);
    const [inactiveAlertOpen, setInActiveAlertOpen] = React.useState(false);
    const [selectedCrypto, setSelectedCrypto] = React.useState('BTC');
    const [activeModalOpen1, setActiveModalOpen1] = React.useState(false);

    let history = useHistory();
    
    const handleActiveModalOpen1 = () => {
        setActiveModalOpen1(true);
    };
    const handleActiveModalClose1 = () => {
        setActiveModalOpen1(false);
    };
    const handleActiveModalOpen = () => {
        setActiveModalOpen(true);
    };
    const handleActiveModalClose = () => {
        setActiveModalOpen(false);
    };
    const ActiveSuccessClose = () => {
        // props.ActivateState(user_id,"savings",true);
        // setSavingActivate(!savingActivate);
        // setActiveModalOpen(false);
        history.push('../phone',user_id);
    };
    const Pay = async () => {
        handleActiveModalOpen1();
        var res = await props.CreatePayment(user_id, 'activate_saving_'+orderId, selectedCrypto, 20);
        pay_id = res.payment_id;
        // getResult(res.payment_id);    
        myInterval = setTimeout(async()=>{
            var res = await props.GetPaymentResult(pay_id);
            if(res == 'done'){
                alert(selectedCrypto+' payment is done!');
                clearInterval(myInterval)
                history.push('/wallet/saving-account');
            }
        }, 3000)         
        // window.location.href="https://calahex.com/bitcoin/index.php?user_id="+user_id+"&order_id=activate_margin_"+orderId+"&amount_usd=100";
        // window.location.href="https://calahex.com/bitcoin/index.php?user_id="+user_id+"&order_id=activate_margin_"+orderId+"&amount_usd=1";
        // setMarginActivate(true);
        // setActiveModalOpen(false);
    };
    // function getResult(payment_id){
    //     if(paymentInfo){
    //         myInterval = setTimeout(async()=>{
    //             var res = await props.GetPaymentResult(payment_id);
    //             if(res == 'pending')
    //                 getResult(payment_id);
    //             else{
    //                 alert(selectedCrypto+' payment is done!');
    //                 history.push('/wallet/saving-account');
    //             }
    //         }, 2000)
    //     }        
    // }
    const handleInActiveAlertOpen = () => {
        setInActiveAlertOpen(true);
    };
    const handleInActiveAlertClose = () => {
        setInActiveAlertOpen(false);
    };
    const InActiveSuccessClose = () => {
        props.ActivateState(user_id,"savings",false);
        setSavingActivate(!savingActivate);
        setInActiveAlertOpen(false);
    };

    const handleTransferState = () => {
        props.ActivateTransferState("Savings");
    }
    const handleChange = (e) => {
        setSelectedCrypto(e.target.value);
    }
    
    useEffect(() => {
        props.GetOrder();
        return () => {
            clearInterval(myInterval);
        }
    }, []);

    return (
        <Grid item xs={12} sm={6}>
            <div className={classes.exchangeBody}>
                <Typography className={classes.textBody}>Savings Account</Typography>
                <Collapse in={hide}>
                    <Typography className={classes.textEst}>Estimated Balance</Typography>
                    <div className={classes.balanceBody}>
                        <Typography className={classes.balanceText}>{amount}</Typography>
                        <Typography className={classes.textBody}>USDT</Typography>
                    </div>
                </Collapse>
                <Typography className={classes.descriptionText}>Transfer crypto to a Savings Account
                    and earn interest with the flexibility to withdraw your funds at any
                    time.</Typography>
                <div className={classes.bottonBody}>
                    {
                        !savingActivate ?
                            <Button
                                variant="contained"
                                color="default"
                                className={classes.defaultButton}
                                onClick={handleActiveModalOpen}>
                                Activate
                            </Button>
                            :
                            <>
                                  <Button
                                    variant="contained"
                                    color="default"
                                    className={classes.defaultButton}
                                    onClick={handleInActiveAlertOpen}
                                >
                                    Inactive
                                </Button>
                                <Link to ="/wallet/transfer-balances" className ={classes.transferText}>
                                    <Button
                                        variant="contained"
                                        color="default"
                                        className={classes.defaultButton}
                                        onClick = {handleTransferState}
                                    >
                                        Transfer
                                    </Button>
                                </Link>
                            </>
                    }
                </div>
            </div>
            <Dialog fullWidth={true} onClose={handleActiveModalClose} aria-labelledby="customized-dialog-title" open={activeModalOpen} >
                <DialogTitle id="customized-dialog-title" onClose={handleActiveModalClose}>
                    Activate
                </DialogTitle>
                <DialogContent dividers>
                    <Typography gutterBottom>
                        {/* You need to pass phone verification and pay $20 to activate this account . <br/> */}
                        You need to pay $20 to activate this account . <br/>
                        Please select the token for this activate payment. <br/>
                        <FormControl variant="outlined" size="small" style={{textAlign:'center', marginTop:10}}>
                            <Select
                                labelId="demo-simple-select-outlined-label"
                                id="demo-simple-select-outlined"
                                name="token_pair_type"
                                onChange={handleChange}
                                value={selectedCrypto}
                            >
                                <MenuItem value='BTC'>BTC</MenuItem>
                                <MenuItem value='ETH'>ETH</MenuItem>
                                <MenuItem value='USDT'>USDT</MenuItem>
                            </Select>
                        </FormControl>       
                    </Typography>
                </DialogContent>
                <DialogActions>
                    <Button autoFocus onClick={Pay} color="primary">
                        Pay
                    </Button>
                    {/* {activate == true &&<Button autoFocus color="primary" disabled>
                        Verified
                    </Button>}
                    {activate == false &&<Button autoFocus onClick={ActiveSuccessClose} color="primary">
                        Verify
                    </Button>} */}
                    <Button autoFocus onClick={handleActiveModalClose} color="primary">
                        Cancel
                    </Button>
                </DialogActions>
            </Dialog>
            <Dialog
                open={inactiveAlertOpen}
                onClose={handleInActiveAlertClose}
                aria-labelledby="alert-dialog-title"
                aria-describedby="alert-dialog-description"
            >
                <DialogTitle id="alert-dialog-title">{"Do you want to inactive?"}</DialogTitle>
                <DialogContent>
                    <DialogContentText id="alert-dialog-description">
                        This is for testing.
                    </DialogContentText>
                </DialogContent>
                <DialogActions>
                    <Button onClick={handleInActiveAlertClose} color="primary">
                        Disagree
                    </Button>
                    <Button onClick={InActiveSuccessClose} color="primary" autoFocus>
                        Agree
                    </Button>
                </DialogActions>
            </Dialog>
            <Dialog fullWidth={true} onClose={handleActiveModalClose} aria-labelledby="customized-dialog-title" open={activeModalOpen1} >
                <DialogTitle id="customized-dialog-title" onClose={handleActiveModalClose1}>
                    Deposit
                </DialogTitle>
                <DialogContent dividers>
                    <Typography gutterBottom>
                        Amount : <strong>{paymentInfo.pay_amount?paymentInfo.pay_amount:''}</strong> {paymentInfo.pay_currency}
                        <br/><br/>
                        <div style={{textAlign:'center'}}>
                            {paymentInfo.pay_address?<img src={"https://chart.googleapis.com/chart?chs=250x250&cht=qr&chl="+paymentInfo.pay_address} alt="Bitcoin QR Code Generator" border="0" />:<img src="https://miro.medium.com/max/441/1*9EBHIOzhE1XfMYoKz1JcsQ.gif" border="0" />}
                        </div>          
                        <br/>
                        Address : <strong>{paymentInfo.pay_address?paymentInfo.pay_address:''}</strong>
                        <br/><br/>
                        Please send crypto into above address carefully.<br/>
                        {paymentInfo.pay_currency == 'USDT' && <strong>Send USDT on omni network.<br/></strong>}
                        If you send incorrect amount or incorrect address, then you will lose your money!
                        <br/><br/>
                        <strong>You need to wait until the payment is done.</strong>
                    </Typography>
                </DialogContent>
                <DialogActions>
                    <Button autoFocus onClick={handleActiveModalClose} color="primary">
                    <CircularProgress
                        className={props.classes.spinner}
                        size={20}
                        style={{marginRight:10}}
                    />Waiting
                    </Button>
                </DialogActions>
            </Dialog>
        </Grid>
    );
}

SavingComponent.propTypes = {
    classes: PropTypes.object.isRequired,
};

const mapStateToProps = state => ({
    activateState : state.wallet.activateState,
    user_id: state.auth.user_id,
    orderId: state.wallet.orderId,
    paymentInfo: state.wallet.paymentInfo,
    paymentResult: state.wallet.paymentResult,
});

const mapDispatchToProps = {
    ActivateState,ActivateTransferState,GetOrder, CreatePayment, GetPaymentResult
};

export default connect(mapStateToProps, mapDispatchToProps)(SavingComponent);
